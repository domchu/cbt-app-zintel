@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Preview Uploaded Questions</h2>

        <form action="{{ route('questions.importConfirmed') }}" method="POST">
            @csrf
            <input type="hidden" name="questions" value="{{ json_encode($questions) }}">

            <table class="table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Year</th>
                        <th>Question</th>
                        <th>Option A</th>
                        <th>Option B</th>
                        <th>Option C</th>
                        <th>Option D</th>
                        <th>Option E</th>
                        <th>Correct Answer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $index => $question)
                        <tr>
                            <td>
                                <input type="text" name="questions[{{ $index }}][subject]" class="form-control"
                                    value="{{ $question['subject'] }}" required>
                            </td>
                            <td>
                                <input type="number" name="questions[{{ $index }}][year]" class="form-control"
                                    value="{{ $question['year'] }}" required>
                            </td>
                            <td>
                                <textarea name="questions[{{ $index }}][question]" class="form-control" required>{{ $question['question'] }}</textarea>
                            </td>
                            <td><input type="text" name="questions[{{ $index }}][option_a]" class="form-control"
                                    value="{{ $question['option_a'] }}" required></td>
                            <td><input type="text" name="questions[{{ $index }}][option_b]" class="form-control"
                                    value="{{ $question['option_b'] }}" required></td>
                            <td><input type="text" name="questions[{{ $index }}][option_c]" class="form-control"
                                    value="{{ $question['option_c'] }}" required></td>
                            <td><input type="text" name="questions[{{ $index }}][option_d]" class="form-control"
                                    value="{{ $question['option_d'] }}" required></td>
                            <td><input type="text" name="questions[{{ $index }}][option_e]" class="form-control"
                                    value="{{ $question['option_e'] }}" required></td>
                            <td>
                                <select name="questions[{{ $index }}][correct_answer]" class="form-control"
                                    required>
                                    <option value="A" {{ $question['correct_answer'] == 'A' ? 'selected' : '' }}>A
                                    </option>
                                    <option value="B" {{ $question['correct_answer'] == 'B' ? 'selected' : '' }}>B
                                    </option>
                                    <option value="C" {{ $question['correct_answer'] == 'C' ? 'selected' : '' }}>C
                                    </option>
                                    <option value="D" {{ $question['correct_answer'] == 'D' ? 'selected' : '' }}>D
                                    </option>
                                    <option value="E" {{ $question['correct_answer'] == 'E' ? 'selected' : '' }}>E
                                    </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Confirm & Save</button>
        </form>

        <a href="{{ route('questions.upload') }}" class="btn btn-secondary">Cancel</a>
    </div>
@endsection
