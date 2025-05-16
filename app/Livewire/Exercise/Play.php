<?php

namespace App\Livewire\Exercise;

use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Play extends Component
{
    public $id;
    public $exercise;
    public $questions;
    public $minutes = 0;
    public $seconds = 0;
    public $finalScore = 0;
    public $confirmPlay = false;
    public $finished = false;
    public $userAnswers = [];
    public $startTime;
    public $results = [];


    public function triggerConfirm()
    {
        $this->confirmPlay = !$this->confirmPlay;
    }


    public function mount($part, $id)
    {
        $this->id = $id;
        $this->exercise = Exercise::findOrFail($id);
        $this->questions = $this->exercise->questions;
        $this->startTime = now();
    }

    public function submitAnswers()
    {
        $elapsed = now()->diffInSeconds($this->startTime);



        $this->confirmPlay = false;
        $this->finished = true;
        if ($this->exercise->part == 1) {
            foreach ($this->questions[0]->choices as $index => $choice) {
                $score = 0;
                $userAnswer = strtolower(trim($this->userAnswers[$index] ?? ''));
                if (!$index == 0) {
                    if ($userAnswer === $choice->is_correct) {
                        $score++;
                    }
                }
                $this->results[$index] = $score;
            }
        }
        if ($this->exercise->part == 2) {
            foreach ($this->questions[0]->answers as $index => $question) {
                $parts = explode('/', strtolower($question->value));
                $score = 0;
                $userAnswer = strtolower(trim($this->userAnswers[$index] ?? ''));
                if (!$index == 0) {
                    if (in_array($userAnswer, $parts)) {
                        $score++;
                    }
                }
                $this->results[$index] = $score;
            }
        }
        if ($this->exercise->part == 3) {
            foreach ($this->questions[0]->answers as $index => $question) {
                $parts = explode('/', strtolower($question->value));
                $score = 0;
                $userAnswer = strtolower(trim($this->userAnswers[$index] ?? ''));
                if (!$index == 0) {
                    if (in_array($userAnswer, $parts)) {
                        $score++;
                    }
                }
                $this->results[$index] = $score;
            }
        }
        if ($this->exercise->part == 4) {
            foreach ($this->questions as $index => $question) {
                $rawAnswer = strtolower($question->answers[0]->value);
                $rawAnswer = preg_replace('/\((.*?)\)/', '', $rawAnswer); // Remove optional bracketed words
                $parts = explode('|', $rawAnswer);
                $score = 0;
                $userAnswer = strtolower(trim($this->userAnswers[$index] ?? ''));

                foreach ($parts as $part) {
                    if (strpos($part, '/') !== false) {
                        $options = explode('/', $part); // Split by `/`
                        foreach ($options as $option) {
                            $option = trim($option);
                            if (preg_match('/\b' . preg_quote($option, '/') . '\b/i', $userAnswer)) {
                                $score++;
                                break;
                            }
                        }
                    } else {
                        $part = trim($part);
                        if (preg_match('/\b' . preg_quote($part, '/') . '\b/i', $userAnswer)) {
                            $score++;
                        }
                    }
                }

                $this->results[$index] = $score;
            }
        }

        $this->finalScore = array_sum($this->results);
        DB::table('user_records')->insert([
            'user_id' => Auth::id(),
            'exercise_id' => $this->exercise->id,
            'score' => $this->finalScore,
            'time_spent' => abs($elapsed),
        ]);
        if ($this->exercise->id == Auth::user()->set_exercise && Auth::user()->role == 'Student') {
            $student = Auth::user();
            $student->set_exercise = null;
            $student->save();
        }
    }

    public function render()
    {
        return view('livewire.exercise.play')->layout('layouts.app');
    }
}
