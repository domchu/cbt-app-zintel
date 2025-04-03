@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Preview Uploaded Questions</h2>
        <h2>Preview, Edit, or Delete Questions Before Saving</h2>

        <form id="confirmForm" action="{{ route('questions.importConfirmed') }}" method="POST">
            @csrf
            <input type="hidden" name="questions" value="{{ json_encode($questions) }}">

            <table class="table" id="questionsTable">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $index => $question)
                        <tr id="row-{{ $index }}">
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
                        <td>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteRow({{ $index }})">Delete</button>
                        </td>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Confirm & Save</button>
        </form>
            <button id="undoDeleteBtn" class="btn btn-warning mt-3" style="display:none;" onclick="undoDelete()">Undo Last Delete</button>

        <a href="{{ route('questions.upload') }}" class="btn btn-secondary">Cancel</a>
    </div>
@endsection
<script>
    let deletedQuestions = [];

    function deleteRow(index) {
        let row = document.getElementById("row-" + index);
        if (row) {
            deletedQuestions.push({ index: index, html: row.outerHTML });
            row.remove();
            document.getElementById("undoDeleteBtn").style.display = "block";
        }
    }

    function undoDelete() {
        if (deletedQuestions.length > 0) {
            let lastDeleted = deletedQuestions.pop();
            let tableBody = document.querySelector("#questionsTable tbody");
            let tempDiv = document.createElement("div");
            tempDiv.innerHTML = lastDeleted.html;
            tableBody.appendChild(tempDiv.firstElementChild);

            if (deletedQuestions.length === 0) {
                document.getElementById("undoDeleteBtn").style.display = "none";
            }
        }
    }
</script>
