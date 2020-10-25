<?php

if (!function_exists('get_text_question')) {
	function get_text_question($response_num, $question)
	{	
        $question_one_text = '';
        $question_two_text = '';
        $question_three_text = '';
        $question_four_text = '';
        $question_five_text = '';
        $question_six_text = '';
        $question_seven_text = '';

		if ($question[0] == 1) {
            $enunciated_question = "Função na empresa ? *";
			$available_response = [
				'1' => 'Pedreiro',
                '2' => 'Servente',
                '3' => 'Armador'
			];
	
			if (!array_key_exists($response_num[0], $available_response)) {
				$question_one_text = $response_num[0];
			}
	
			$question_one_text = $available_response[$response_num[0]];
        }
        
        if ($question[1] == 2) {
            $enunciated_question = "Com quantas pessoas você mora ? *";
			$available_response = [
				'1' => 'Sozinho',
                '2' => 'Até 1',
                '3' => 'Mais de 1'
			];
	
			if (!array_key_exists($response_num[1], $available_response)) {
				$question_two_text = $response_num[1];
			}
	
			$question_two_text = $available_response[$response_num[1]];
        }
        
        if ($question[2] == 3) {
            $enunciated_question = "Qual meio de transporte você utiliza frequentemente ? *";
			$available_response = [
				'1' => 'Transporte Público',
                '2' => 'Particular'
			];
	
			if (!array_key_exists($response_num[2], $available_response)) {
				$question_three_text = $response_num[2];
			}
	
			$question_three_text = $available_response[$response_num[2]];
        }
        
        if ($question[3] == 4) {
            $enunciated_question = "Teve contato com alguém com covid-19 ? *";
			$available_response = [
				'1' => 'Sim',
                '2' => 'Não',
                '3' => 'Não sei'
			];
	
			if (!array_key_exists($response_num[3], $available_response)) {
				$question_four_text = $response_num[3];
			}
	
			$question_four_text = $available_response[$response_num[3]];
        }
        
        if ($question[4] == 5) {
            $enunciated_question = "Nos últimos 8 dias, sentiu algum desses sintomas ? *";
			$available_response = [
				'1' => 'Febre',
                '2' => 'Dores na garganta',
                '3' => 'Tosse seca',
                '4' => 'Diarreia',
                '5' => 'Dores de cabeça',
                '6' => 'Falta de ar ou cansaço',
                '7' => 'Perca de olfato ou paladar',
                '8' => 'Nenhuma desses acima'
             ];

            $i = 1;
            $count = count($response_num[4]);
            
            foreach($response_num[4] as $res_num) {

                if (!array_key_exists($res_num, $available_response)) {
                    $question_five_text = $i > 1 && $i < 7 ? $res_num . ', ' :
                    $res_num;
                }

                $question_five_text = $i < $count ?  $question_five_text . $available_response[$res_num] . ', ' :
                $question_five_text . $available_response[$res_num];

                $i++;
            }
        }
        
        if ($question[5] == 6) {
            $enunciated_question = "Alguém que reside no mesmo ambiente que você teve alguns desse sintomas ? *";
			$available_response = [
				'1' => 'Sim',
                '2' => 'Não',
                '3' => 'Não tenho certeza'
			];
	
			if (!array_key_exists($response_num[5], $available_response)) {
				$question_six_text = $response_num[5];
			}
	
			$question_six_text = $available_response[$response_num[5]];
        }

        if ($question[6] == 7) {
            $enunciated_question = "Confirmo que todas as respostas acima são verdadeiras. *";
	
			$question_seven_text = $response_num[6] ? 'Sim' : 'Não';
        }

        $responses = [];
        $responses[] = $question_one_text;
        $responses[] = $question_two_text;
        $responses[] = $question_three_text;
        $responses[] = $question_four_text;
        $responses[] = $question_five_text;
        $responses[] = $question_six_text;
        $responses[] = $question_seven_text;

        return $responses;
	}
}