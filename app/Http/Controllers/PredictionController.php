<?php

namespace App\Http\Controllers;

use App\Models\Processes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    // Make prediction by using Flask API
    public function predictNews(Request $request) {
        $response = Http::get('http://127.0.0.1:5000/predict?message=' . $request->news);
        $jsonData = $response->json();
        if($jsonData == null) {
            return redirect()->back()->with('ErrorPrediction', 'Unexepected error occured, Please try again');
        }
        if(auth()->check()) {
            $this->savePrediction($jsonData['prediction'], $request->news);
        }
        return redirect('home#classify')->with('successPrediction', $jsonData['prediction']);
    }
    
    // Make predictoin by using URL
    public function predictNewsWithURL(Request $request) {
        $validatedData = $request->validate([
            'newsURL' => 'required|url',
        ]);
        $response = Http::get('http://127.0.0.1:5000//predict-with-url?url=' . $request->newsURL);
        $jsonData = $response->json();

        if($jsonData == null) {
            return redirect()->back()->with('ErrorPredictionWithURL', 'Unexepected error occured, Please try again');
        }
        if(auth()->check()) {
            $this->savePrediction($jsonData['prediction'], $request->newsURL);
        }
        return redirect('home#calssifyByURL')->with('successPredictionWithURL', $jsonData['prediction']);
    }

    // Save performed processes in database
    public function savePrediction($prediction, $news) {
        if($prediction === "['REAL']") {
            $prediction = 1;
        } else {
            $prediction = 0;
        }
        $process = Processes::create([
            'user_id' => auth()->user()->id,
            'processText' => $news,
            'result' => $prediction,
        ]);
    }
    
}
