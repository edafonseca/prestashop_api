<?php

namespace PsHttp\Generator;

use PhpParser\BuilderFactory;
use PhpParser\Node\Expr;

class Generator
{
    public function generate()
    {
        $factory = new BuilderFactory();
        $node = $factory->namespace('Name\Space')
            ->addStmt($factory->use('Some\Other\Thingy')->as('SomeClass'))
            ->addStmt($factory->useFunction('strlen'))
            ->addStmt($factory->useConst('PHP_VERSION'))
            ->addStmt($factory->class('SomeOtherClass')
                ->extend('SomeClass')
                ->implement('A\Few', '\Interfaces')
                ->makeAbstract() // ->makeFinal()

                ->addStmt($factory->useTrait('FirstTrait'))

                ->addStmt($factory->useTrait('SecondTrait', 'ThirdTrait')
                    ->and('AnotherTrait')
                    ->with($factory->traitUseAdaptation('foo')->as('bar'))
                    ->with($factory->traitUseAdaptation('AnotherTrait', 'baz')->as('test'))
                    ->with($factory->traitUseAdaptation('AnotherTrait', 'func')->insteadof('SecondTrait')))

                ->addStmt($factory->method('someMethod')
                    ->makePublic()
                    ->makeAbstract() // ->makeFinal()
                    ->setReturnType('bool') // ->makeReturnByRef()
                    ->addParam($factory->param('someParam')->setType('SomeClass'))
                    ->setDocComment('/**
                              * This method does something.
                              *
                              * @param SomeClass And takes a parameter
                              */')
                )

                ->addStmt(
                    $factory->method('anotherMethod')
                    ->makeProtected() // ->makePublic() [default], ->makePrivate()
                    ->addParam($factory->param('someParam')->setDefault('test'))
                    // it is possible to add manually created nodes
                    ->addStmt(
                        new Expr\Print_(new Expr\Variable('someParam'))
                    )
                )

                // properties will be correctly reordered above the methods
                ->addStmt($factory->property('someProperty')->makeProtected())
                ->addStmt($factory->property('anotherProperty')->makePrivate()->setDefault(array(1, 2, 3)))
            )

            ->getNode()
        ;


        $stmts = array($node);
        $prettyPrinter = new PrettyPrinter\Standard();
        echo $prettyPrinter->prettyPrintFile($stmts);
    }
}
