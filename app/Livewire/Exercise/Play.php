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
    public $confirm = false;
    public $finished = false;
    public $userAnswers = [];
    public $startTime;
    public $results = [];


    public function triggerConfirm()
    {
        $this->confirm = !$this->confirm;
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



        $this->confirm = false;
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
                $parts = explode('|', strtolower($question->answers[0]->value));
                $score = 0;
                $userAnswer = strtolower(trim($this->userAnswers[$index] ?? ''));
                foreach ($parts as $part) {
                    if (strpos($part, '/') !== false) {
                        $options = explode('/', $part); // Split by `/`
                        foreach ($options as $option) {
                            if (preg_match('/\b' . preg_quote(trim($option), '/') . '\b/i', $userAnswer)) {
                                $score++;
                                break;
                            }
                        }
                    } else {
                        if (preg_match('/\b' . preg_quote(trim($part), '/') . '\b/i', $userAnswer)) {
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
    }

    public function render()
    {
        return view('livewire.exercise.play')->layout('layouts.app');
    }
}
