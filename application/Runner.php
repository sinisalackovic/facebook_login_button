<?php


namespace App;

use G4\Runner\Logger;
use G4\Constants\Http;
use G4\Runner\Profiler;
use G4\Runner\Presenter;
use G4\Constants\Parameters;
use G4\Log\Logger as LogLogger;
use G4\Runner\ResponseFormatter;
use G4\Runner\Presenter\ContentType;
use G4\Runner\Presenter\DataTransfer;
use G4\Runner\Presenter\HeaderAccept;
use G4\Runner\Presenter\Formatter\FormatterInterface;

class Runner implements \G4\Runner\RunnerInterface
{

    /**
     * @var \G4\CleanCore\Application
     */
    private $application;

    /**
     * @var string
     */
    private $applicationMethod;

    /**
     * @var \G4\Commando\Cli
     */
    private $commando;

    /**
     * @var HeaderAccept
     */
    private $headerAccept;

    /**
     * @var \G4\Http\Request
     */
    private $httpRequest;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Profiler
     */
    private $profiler;

    /**
     * @var ResponseFormatter
     */
    private $responseFormatter;

    /**
     * @var array
     */
    private $routerOptions;

    public function __construct($headerAccept = null)
    {
        $this->profiler          = new Profiler();
        $this->logger            = new Logger();
        $this->responseFormatter = new ResponseFormatter();
        $this->headerAccept 	 = $headerAccept ? $headerAccept : new HeaderAccept();
    }

    public function bootstrap(){}

    public function getApplication()
    {
        return $this->application;
    }

    public function getApplicationMethod()
    {
        return $this->applicationMethod;
    }

    public function getApplicationModule()
    {
        return ucwords($this->routerOptions['module']);
    }

    public function getApplicationParams()
    {
        return $this->getHttpRequest()->isCli()
            ? json_decode($this->commando->value('params'), true)
            : $this->getReqParams();
    }

    public function getApplicationService()
    {
        return ucwords($this->routerOptions['service']);
    }

    public function getHttpRequest()
    {
        if(null === $this->httpRequest) {
            $this->httpRequest = new \G4\Http\Request();
        }
        return $this->httpRequest;
    }

    public function registerProfilerTicker(\G4\Profiler\Ticker\TickerAbstract $profiler)
    {
        $this->profiler->addProfiler($profiler);
        return $this;
    }

    public function registerRequestLogger(LogLogger $logger)
    {
        $this->logger->setLogger($logger);
        return $this;
    }

    public function registerFormatterBasic(FormatterInterface $formatter)
    {
        $this->responseFormatter->addBasic($formatter);
        return $this;
    }

    public function registerFormatterVerbose(FormatterInterface $formatter)
    {
        $this->responseFormatter->addVerbose($formatter);
        return $this;
    }

    public final function run()
    {
        $this->route();
        $this->parseApplicationMethod();

        $this->application = new Application($this);

        $this->logger->logRequest($this->application);

        $this->application->run();

        $contentType = new ContentType($this->getDataTransfer(), $this->headerAccept);

        (new Presenter($this->responseFormatter, $contentType))->render();

         $this->logger->logResponse($this->application, $this->profiler);
    }

    public function setCommando(\G4\Commando\Cli $commando)
    {
        $this->commando = $commando;
        return $this;
    }

    private function getDataTransfer()
    {
        return new DataTransfer(
            $this->getHttpRequest(),
            $this->profiler,
            $this->application->getRequest(),
            $this->application->getResponse());
    }

    private function getReqParams()
    {
        $params = $this->getHttpRequest()->getParams();
        if(isset($this->routerOptions['url_part']) && is_array($params)){
            $params['url_part'] = $this->routerOptions['url_part'];
        }
        return $params;
    }

    private function parseApplicationMethod()
    {
        if ($this->getHttpRequest()->isCli()) {
            $params = $this->commando->has('params')
                ? json_decode($this->commando->value('params'), true)
                : [];
            $method = $this->commando->has('method')
                ? strtoupper($this->commando->value('method'))
                : null;
            $id     = isset($params[Parameters::ID])
                ? $params[Parameters::ID]
                : null;
        } else {
            $method = $this->getHttpRequest()->getMethod();
            $id     = $this->getHttpRequest()->getParam(Parameters::ID);
        }

        $this->applicationMethod = ($method == Http::METHOD_GET && empty($id))
            ? 'Index'
            : ucwords(strtolower($method));
        return $this;
    }

    private function route()
    {
        $this->routerOptions = !$this->getHttpRequest()->isCli()
            ? require_once PATH_CONFIG . '/routes.php'
            : [
                'module'  => $this->commando->value('module'),
                'service' => $this->commando->value('service'),
            ];
        return $this;
    }
}