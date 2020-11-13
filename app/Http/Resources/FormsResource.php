<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class FormsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response_ready_translate[0] = $this->qone_response;
        $response_ready_translate[1] = $this->qtwo_response;
        $response_ready_translate[2] = $this->qthree_response;
        $response_ready_translate[3] = $this->qfour_response;
        $response_ready_translate[4] = json_decode($this->qfive_response, true);
        $response_ready_translate[5] = $this->qsix_response;
        $response_ready_translate[6] = $this->qseven_response;

        $question[0] = 1;
        $question[1] = 2;
        $question[2] = 3;
        $question[3] = 4;
        $question[4] = 5;
        $question[5] = 6;
        $question[6] = 7;
        // dd($question);
        $var = get_text_question($response_ready_translate, $question );
        $date = Carbon::parse($this->created_at, 'UTC');
        return [
            'name' => $this->name,
            'email' => $this->email,
            'qone_response' => $var[0],
            'qtwo_response' => $var[1],
            'qthree_response' => $var[2],
            'qfour_response' => $var[3],
            'qfive_response' => $var[4],
            'qsix_response' => $var[5],
            'qseven_response' => $var[6],
            'alert_text' => $this->alert_text,
            'points_covid' => $this->points_covid,
            'created_at' => $date->isoFormat('MMMM Do YYYY, h:mm:ss a'),
        ];
    }
}
