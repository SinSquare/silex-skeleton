<?php

$finder = Symfony\CS\Finder::create()
    ->in(__DIR__.'/app')
    ->in(__DIR__.'/config')
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/web')
    ->name('*.php')
;

return Symfony\CS\Config::create()
    ->fixers(array('ordered_use','align_double_arrow','unalign_equals'))
    ->finder($finder)
;