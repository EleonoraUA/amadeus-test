<?php


namespace App\Services;


use App\Exception\AlgorithmNotFoundException;
use App\Services\LoggerStrategies\AbstractLoggerStrategy;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class HashServiceCompiler
 * @package App\Services
 */
class LoggerServiceCompiler implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @throws AlgorithmNotFoundException
     */
    public function process(ContainerBuilder $container)
    {
        $contextDefinition = $container->findDefinition(LoggerService::class);
        $logAlgorithm = $container->getParameter('logAlgorithm');

        $taggedStrategies = $container->findTaggedServiceIds('logger_strategy');
        $loggerClassName = AbstractLoggerStrategy::getNamespace() . ucfirst($logAlgorithm) . 'LogStrategy';

        if (!isset($taggedStrategies[$loggerClassName])) {
            throw new AlgorithmNotFoundException('Logger Class Name not found ' . $loggerClassName);
        }

        $contextDefinition->addMethodCall(
            'setCurrentLogStrategy',
            array(new Reference($loggerClassName))
        );
    }
}