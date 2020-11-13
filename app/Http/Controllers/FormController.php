<?php

namespace App\Http\Controllers;

use App\Models\Mysql\Form;
use Illuminate\Http\Request;
use Log;
use App\Http\Resources\FormsResource  as FormResource;

class FormController extends Controller
{
    protected $point = 40000;

    public function index(Request $request)
    {

        $forms = Form::all();

        return response([
            'forms' => FormResource::collection($forms)
        ], 200);
    }

    public function create(Request $request)
    {

        $form = $request->form;

        $points_covid = 0;
        $alert = '';
        switch ($form['q2']) {
            case 1:
                $points_covid = 0;
                break;
            case 2:
                $points_covid = $points_covid + 10;
                break;
            case 3:
                $points_covid = $points_covid + 20;
                break;
        }

        switch ($form['q3']) {
            case 1:
                $points_covid = $points_covid + 0;
                break;
            case 2:
                $points_covid = $points_covid + 40;
                break;
        }

        switch ($form['q4']) {
            case 1:
                $points_covid = $points_covid + 5000;
                break;
            case 2:
                $points_covid = $points_covid + 0;
                break;
            case 3:
                $points_covid = $points_covid + 20;
                break;
        }

        foreach ($form['q5'] as $q5) {


            if ($q5 == 8) {
                continue;
            }

            if ($q5 == 1) {
                $points_covid = $points_covid + 200;
                continue;
            }

            if ($q5 == 2) {
                $points_covid = $points_covid + 500;
                continue;
            }

            if ($q5 == 3) {
                $points_covid = $points_covid + 200;
                continue;
            }

            if ($q5 == 4) {
                $points_covid = $points_covid + 500;
                continue;
            }

            if ($q5 == 5) {
                $points_covid = $points_covid + 200;
                continue;
            }

            if ($q5 == 6) {
                $points_covid = $points_covid + 1000;
                continue;
            }

            if ($q5 == 7) {
                $points_covid = $points_covid + 800;
                continue;
            }
        }

        switch ($form['q6']) {
            case 1:
                $points_covid = $points_covid + 100;
                break;
            case 2:
                $points_covid = $points_covid + 0;
                break;
            case 3:
                $points_covid = $points_covid + 10;
                break;
        }

        // $response_ready_translate[0] = $form->q1;
        // $response_ready_translate[1] = $form->q2;
        // $response_ready_translate[2] = $form->q3;
        // $response_ready_translate[3] = $form->q4;
        // $response_ready_translate[4] = $form->q5;
        // $response_ready_translate[5] = $form->q6;
        // $response_ready_translate[6] = $form->term;

        // $question[0] = 1;
        // $question[1] = 2;
        // $question[2] = 3;
        // $question[3] = 4;
        // $question[4] = 5;
        // $question[5] = 6;
        // $question[6] = 7;
        // // dd($question);
        // $var = get_text_question($response_ready_translate, $question );

        // dd($var);
        // // Log::info($request->all());
        // Log::info($request->form);
        // // Log::info(json_encode($request->form));

        switch (true) {
            case $points_covid <= 5000 && $points_covid >= 4000:
                $alert = 'ALTO';
                break;
            case $points_covid > 5000:
                $alert = 'MUITO ALTO';
                break;
            case $points_covid <= 4000 && $points_covid >= 2000:
                $alert = 'MODERADO';
                break;
            case $points_covid <= 2000:
                $alert = 'BAIXO';
                break;
        }

        $register_form = Form::create([
            'name' => $form['name'],
            'email' => $form['email'],
            'qone_enunciated' => get_enunciated_question('q1'),
            'qone_response' => $form['q1'],
            'qtwo_enunciated' => get_enunciated_question('q2'),
            'qtwo_response' => $form['q2'],
            'qthree_enunciated' => get_enunciated_question('q3'),
            'qthree_response' => $form['q3'],
            'qfour_enunciated' => get_enunciated_question('q4'),
            'qfour_response' => $form['q4'],
            'qfive_enunciated' => get_enunciated_question('q5'),
            'qfive_response' => json_encode($form['q5']),
            'qsix_enunciated' => get_enunciated_question('q6'),
            'qsix_response' => $form['q6'],
            'qseven_enunciated' => get_enunciated_question('q7'),
            'qseven_response' => $form['term'],
            'alert_text' => $alert,
            'points_covid' => $points_covid,
        ]);

        $register_form->save();



        return response([
            'points_covid' => $points_covid,
            'resume' => $alert,
            'message' => 'Respostas enviadas com sucesso!'
        ], 200);
    }
}
