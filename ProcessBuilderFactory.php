<?php

namespace Epubli\Pdf\XpdfTools;

/**
 * Class ProcessBuilderFactory is a service that creates new instances of various ProcessBuilders.
 *
 * This class solves a problem we are facing when we need to run external processes (which can conveniently be achieved
 * with the Symfony Process Component) but want these processes to be mockable in unit test scenarios.
 *
 * Here is a little history to explain the problem:
 *
 * If we want to mock up the Process object in the tested unit depending on it, i. e. the class utilizing the Process
 * class, we have to inject that Process object dependency (or even better: a ProcessBuilder object). As each Process
 * object is intended for single use and so is each ProcessBuilder object, they are by their nature not to be registered
 * as services in the ServiceContainer:
 * http://symfony.com/doc/current/book/service_container.html#what-is-a-service
 * We did this anyway but we had to declare that service to exist in the prototype scope to get a new instance with each
 * request:
 * https://bitbucket.org/epubli/epubli-symfony/commits/e0bb60ba5#Lsrc/Epubli/MainBundle/Resources/config/services.ymlT11
 * and http://symfony.com/doc/2.7/cookbook/service_container/scopes.html
 * Consequentially all other services depending (directly or transitively!) on the process builder service would either
 * have to live in prototype scope as well or have the whole service container injected as dependency:
 * http://symfony.com/doc/2.7/cookbook/service_container/scopes.html#using-a-service-from-a-narrower-scope
 * What we actually did was using a hack:
 * https://bitbucket.org/epubli/epubli-symfony/commits/e0bb60ba5#Lsrc/Epubli/MainBundle/Resources/config/services.ymlT47
 * Setting a dependency to be not strict (appending '=' in YAML) makes Symfony ignore the scope widening exception:
 * http://stackoverflow.com/questions/10227220/removing-symfony2-scope-widening-notice#answer-10231005
 * Effectively this resulted in the same process builder service object being used everywhere which led to the next
 * hack: We had to create a new object inside the methods using the service:
 * https://bitbucket.org/epubli/epubli-symfony/commits/581249ba86e09b18#Lsrc/Epubli/MainBundle/Service/Pdf/Filter.phpT96
 * This turned out to be untestable as the newly created object could not be mocked up in tests. Next hack: Let the unit
 * act differently under test:
 * https://bitbucket.org/epubli/epubli-symfony/commits/b61c2d831e2f2db#Lsrc/Epubli/MainBundle/Service/Pdf/Filter.phpT100
 *
 * So that is the dilemma:
 *
 * On the one hand we want a new process builder each time we start a process, on the other hand we want the process
 * builder object to be mockable (i. e. addressable) in unit tests.
 *
 * The solution:
 *
 * Separate both aspects into two classes. Entering ProcessBuilderFactory.
 *
 * @package Epubli\Pdf\XpdfTools
 */
class ProcessBuilderFactory
{
    /**
     * @param string $key
     * @return BaseProcessBuilder
     * @throws Exception
     */
    public function create($key)
    {
        switch ($key) {
            case 'pdfinfo':
                return new PdfInfoProcessBuilder();
            case 'pdffonts':
                return new PdfFontsProcessBuilder();
            case 'pdfimages':
                return new PdfImagesProcessBuilder();
            case 'pdftotext':
                return new PdfToTextProcessBuilder();
            case 'pdftohtml':
                return new PdfToHtmlProcessBuilder();
            case 'pdftoppm':
                return new PdfToPpmProcessBuilder();
            default:
                throw new Exception("Xpdf tools process builder for key '$key' does not exist.");
        }
    }
}
