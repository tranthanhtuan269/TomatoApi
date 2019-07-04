<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\QuestionTransformer;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->search)){
            $questions = fractal()
                    ->collection(Question::where('active', 1)->get())
                    ->transformWith(new QuestionTransformer)
                    ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'List questions',
                'questions' => $questions
            ], 200);
        }else{
            $questions = fractal()
                    ->collection(Question::where('question', 'like', '%' . $request->search . '%')->where('active', 1)->get())
                    ->transformWith(new QuestionTransformer)
                    ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'List questions',
                'questions' => $questions
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'question' => 'required|string|max:500|unique:questions',
            'answerOne' => 'required|string|max:500',
            'answerTwo' => 'required|string|max:500',
            'answerThree' => 'required|string|max:500',
            'answerFour' => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the question.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $question = new Question([
            'question' => $request->question,
            'answerOne' => $request->answerOne,
            'answerTwo' => $request->answerTwo,
            'answerThree' => $request->answerThree,
            'answerFour' => $request->answerFour,
            'trueAnswer' => 1
        ]);

        if($question->save()){
            return \Response::json(array('status' => '201', 'message' => 'The question has been created'));   
        }else{
            return \Response::json(array('status' => '204', 'message' => 'Failed to create a new question'));   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        if($question){
            $finder = fractal()
                ->item($question)
                ->transformWith(new QuestionTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'question' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this question.'
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'question' => 'required|string|max:500|unique:questions,question,'.$id,
            'answerOne' => 'required|string|max:500',
            'answerTwo' => 'required|string|max:500',
            'answerThree' => 'required|string|max:500',
            'answerFour' => 'required|string|max:500',
            'trueAnswer' => 'required|string|max:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the question.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $question = Question::find($id);

        if($question){
            $question->question = $request->question;
            $question->answerOne = $request->answerOne;
            $question->answerTwo = $request->answerTwo;
            $question->answerThree = $request->answerThree;
            $question->answerFour = $request->answerFour;
            $question->trueAnswer = $request->trueAnswer;
            
            if($question->save()){
                $updated = fractal()
                    ->item($question)
                    ->transformWith(new QuestionTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'The question has been updated',
                    'question' => $updated
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update a question.',
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this question.',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        if($question){
            if($question->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this question successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this question.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this question.',
            ], 200);
        }
    }
}
