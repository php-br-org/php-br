<?php

namespace Phpbr\Bundle\AppBundle\Twig;

class TempoExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'tempo_passado',
                array (
                    $this,
                    'getTempoPassadoFilter'
                )
            )
        );
    }

    public function getTempoPassadoFilter($timestamp) {
        $since = time() - $timestamp;

        $chunks = array(
            array(60 * 60 * 24 * 365 , 'ano'),
            array(60 * 60 * 24 * 30 , 'mes'),
            array(60 * 60 * 24 * 7, 'semana'),
            array(60 * 60 * 24 , 'dia'),
            array(60 * 60 , 'hora'),
            array(60 , 'minuto'),
            array(1 , 'segundo') 
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        if ($name == "mes")
        {
            $plural = "es";
        } else {
            $plural = "s";
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}" .$plural;
        return $print;
    }

    public function getName() {
        return 'tempo_extension';
    }
}

