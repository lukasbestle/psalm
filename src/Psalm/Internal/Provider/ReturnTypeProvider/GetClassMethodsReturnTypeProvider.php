<?php
namespace Psalm\Internal\Provider\ReturnTypeProvider;

use PhpParser;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\StatementsSource;
use Psalm\Type;

class GetClassMethodsReturnTypeProvider implements \Psalm\Plugin\Hook\FunctionReturnTypeProviderInterface
{
    /**
     * @return array<lowercase-string>
     */
    public static function getFunctionIds() : array
    {
        return [
            'get_class_methods',
        ];
    }

    /**
     * @param  list<PhpParser\Node\Arg>    $call_args
     */
    public static function getFunctionReturnType(
        StatementsSource $statements_source,
        string $function_id,
        array $call_args,
        Context $context,
        CodeLocation $code_location
    ): ?Type\Union {
        if (!$statements_source instanceof \Psalm\Internal\Analyzer\StatementsAnalyzer
            || !$call_args
        ) {
            return Type::getMixed();
        }

        if (($first_arg_type = $statements_source->node_data->getType($call_args[0]->value))
             && ($first_arg_type->hasObjectType() || $first_arg_type->hasString())
        ) {
            return Type::parseString('array<string>');
        }

        return null;
    }
}
