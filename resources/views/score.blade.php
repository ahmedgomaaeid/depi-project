<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Score - eLearning Platform</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (for icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f4f4f9;
    }

    .score-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      text-align: center;
    }

    .score-header {
      margin-bottom: 30px;
    }

    .score-header h1 {
      font-size: 2.5rem;
      color: #007bff;
      font-weight: bold;
    }

    .score-display {
      font-size: 5rem;
      font-weight: bold;
      color: #28a745;
    }

    .feedback-message {
      font-size: 1.5rem;
      margin: 20px 0;
    }

    .feedback-message i {
      margin-right: 10px;
    }

    .score-actions {
      margin-top: 30px;
    }

    .score-actions button {
      padding: 10px 20px;
      font-size: 1.2rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      margin: 0 10px;
    }

    .score-actions button:hover {
      background-color: #0056b3;
    }

    .score-actions .btn-secondary {
      background-color: #6c757d;
    }

    .score-actions .btn-secondary:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>

<div class="score-container">
  <div class="score-header">
    <h1>Your Quiz Results</h1>
  </div>

  <!-- Score Display -->
  <div class="score-display">
    {{$score}}%
  </div>

  <!-- Feedback Message -->
  @if($score >= 50)
    <div class="feedback-message text-success">
        <i class="fas fa-check-circle"></i> Great job! You passed the quiz.
    </div>
    <!-- Action Buttons -->
  <div class="score-actions">
    <a href="{{route('lesson.show', $quiz->after_lesson)}}" class="btn btn-secondary">Go to Dashboard</a>
  </div>
    @else
    <div class="feedback-message text-danger">
        <i class="fas fa-times-circle"></i> Sorry, you did not pass the quiz.
        <!-- Action Buttons -->
    <div class="score-actions">
        <a href="{{route('quiz.show', $quiz->id)}}" class="btn btn-primary">Retake Quiz</a>
    </div>
    </div>
    @endif


</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
