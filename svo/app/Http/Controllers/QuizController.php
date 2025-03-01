<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

      
        $completedQuizIds = [];


        if (Auth::check()) {
            $user = Auth::user();
            $completedQuizIds = $user->quizzes()
                ->whereNotNull('completed_at')
                ->pluck('quiz_id')
                ->toArray();
        }

        return Inertia::render('Quiz/Index', [
            'quizzes' => $quizzes,
            'completedQuizIds' => $completedQuizIds,
        ]);
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to create a quiz.');
        }

        return Inertia::render('Quiz/Create');
    }

    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You need to log in to create a quiz.');
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'reward_coins' => 'required|integer|min:0',
        'questions' => 'required|array|min:1',
        'questions.*.question_text' => 'required|string',
        'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'questions.*.answers' => 'required|array|min:1',
        'questions.*.answers.*.answer_text' => 'required|string',
        'questions.*.answers.*.is_correct' => 'required|boolean',
    ]);

    $quiz = Quiz::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'reward_coins' => $validated['reward_coins'],
    ]);

    foreach ($validated['questions'] as $questionData) {
        $question = $quiz->questions()->create([
            'question_text' => $questionData['question_text'],
        ]);

        if (isset($questionData['image'])) {
            $imagePath = $questionData['image']->store('question_images', 'public');
            $question->update(['image' => $imagePath]);
        }

        foreach ($questionData['answers'] as $answerData) {
            $question->answers()->create([
                'answer_text' => $answerData['answer_text'],
                'is_correct' => $answerData['is_correct'],
            ]);
        }
    }

    return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
}

    public function take(Quiz $quiz)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to take a quiz.');
        }

        $user = Auth::user();


        if ($user->quizzes()->where('quiz_id', $quiz->id)->whereNotNull('completed_at')->exists()) {
            return redirect()->route('quizzes.index')->with('error', 'You have already completed this quiz.');
        }

        $quiz->load('questions.answers');

        return Inertia::render('Quiz/TakeQuiz', [
            'quiz' => $quiz,
        ]);
    }

    public function complete(Request $request, Quiz $quiz)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You need to log in to complete a quiz.');
    }

    $user = Auth::user();

    if ($user->quizzes()->where('quiz_id', $quiz->id)->whereNotNull('completed_at')->exists()) {
        return redirect()->route('quizzes.index')->with('error', 'You have already completed this quiz.');
    }

    $submittedAnswers = $request->input('answers');

    if (!$submittedAnswers) {
        return redirect()->back()->with('error', 'No answers submitted.');
    }

    $correctAnswersCount = 0;

    foreach ($submittedAnswers as $questionId => $answerIds) {
        if (!is_array($answerIds)) {
            $answerIds = [$answerIds];
        }

        $correctAnswers = Answer::where('question_id', $questionId)
            ->where('is_correct', true)
            ->pluck('id')
            ->toArray();

      
        $correctAnswersCount += count(array_intersect($answerIds, $correctAnswers));
    }

    $totalQuestions = $quiz->questions->count();
    $isPerfectScore = $correctAnswersCount === $totalQuestions;

    if ($isPerfectScore) {
        $user->increment('coins', $quiz->reward_coins);
    }

    $user->quizzes()->attach($quiz->id, ['completed_at' => now()]);

    return Inertia::render('Quiz/Results', [
        'quiz' => $quiz,
        'correctAnswers' => $correctAnswersCount,
        'totalQuestions' => $totalQuestions,
        'isPerfectScore' => $isPerfectScore,
        'rewardCoins' => $isPerfectScore ? $quiz->reward_coins : 0,
    ]);
}
}