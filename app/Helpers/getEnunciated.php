<?php

if (!function_exists('get_enunciated_question')) {
	function get_enunciated_question($question)
	{   
        $enunciated = '';

        switch ($question) {
            case 'q1':
                $enunciated = "Função na empresa ? *";
                break;
            case 'q2':
                $enunciated = "Com quantas pessoas você mora ? *";
                break;
            case 'q3':
                $enunciated = "Qual meio de transporte você utiliza frequentemente ? *";
                break;
            case 'q4':
                $enunciated = "Teve contato com alguém com covid-19 ? *";
                break;
            case 'q5':
                $enunciated = "Nos últimos 8 dias, sentiu algum desses sintomas ? *";
                break;
            case 'q6':
                $enunciated = "Alguém que reside no mesmo ambiente que você teve alguns desse sintomas ? *";
                break;
            case 'q7':
                $enunciated = "Confirmo que todas as respostas acima são verdadeiras. *";
                break;
        }

        return $enunciated;

    }
}

