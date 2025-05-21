@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Preview/Edit/Delete/Restore Uploaded Questions</h2>

                <form action="{{ route('questions.importConfirmed') }}" method="post">
                    @csrf
                    <input type="hidden" name='questions' value="{{ json_encode($questions) }}">
                    <table class="table table-stripe table:hover">
                        <thead>
                            <tr>
                                <th>Subject ID</th>
                                <th>Subject</th>
                                <th>Year</th>
                                <th>Exam Type</th>
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
                                        <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['subject']"
                                            value="{{ $question['subject'] }}">
                                    </td>
                                    <td> <input type="number" class="form-control"
                                            name="questions[{{ $index }}]['year']" value="{{ $question['year'] }}">
                                    </td>
                                    <td> <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['exam_type']"
                                            value="{{ $question['exam_type'] }}"> </td>
                                    <td>
                                        <textarea class="form-control" name="questions[{{ $index }}]['subject']">{{ $question['question'] }}</textarea>
                                    </td>
                                    <td> <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['option_a']"
                                            value="{{ $question['option_a'] }}"> </td>
                                    <td> <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['option_b']"
                                            value="{{ $question['option_b'] }}"> </td>
                                    <td> <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['option_c']"
                                            value="{{ $question['option_c'] }}"> </td>
                                    <td> <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['option_d']"
                                            value="{{ $question['option_d'] }}"> </td>
                                    <td> <input type="text" class="form-control"
                                            name="questions[{{ $index }}]['option_e']"
                                            value="{{ $question['option_e'] }}"> </td>
                                    <td>
                                        <select name="questions[{{ $index }}][correct_answer]" class="form-control"
                                            required>
                                            <option value="A"
                                                {{ $question['correct_answer'] == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B"
                                                {{ $question['correct_answer'] == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C"
                                                {{ $question['correct_answer'] == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D"
                                                {{ $question['correct_answer'] == 'D' ? 'selected' : '' }}>D</option>
                                            <option value="E"
                                                {{ $question['correct_answer'] == 'E' ? 'selected' : '' }}>E</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deleteRow({{ $index }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Confirm & Save</button>
                </form>
                <button class="btn btn-warning mt-s" id="undoDeleteBtn" style="display: none" onclick="undoDelete()">Undo
                    Last Delete</button>
                {{-- <a href="{{ route('questions.upload') }}" class="btn btn-secondary">Cancel</a> --}}
            </div>
        </div>
    </div>
    <script>
        let deleteQuestions = [];

        function deleteRow(index) {
            let row = document.getElementById('row-' + index);
            if (row) {
                deleteQuestions.push({
                    index: index,
                    html: row.outerHTML
                });
                row.remove();
                document.getElementById("undoDeleteBtn").style.display = "block";
            }
        }

        function undoDelete() {
            if (deleteQuestions.length > 0) {
                let lastDeleted = deleteQuestions.pop();
                let tableBody = document.querySelector("#questionsTabletbody");
                let tempDiv = document.createElement("div");
                tempDiv.innerHTML = lastDeleted.html;
                tableBody.appendChild(tempDiv.firstElementChild);
                if (deleteQuestions.length === 0) {
                    document.getElementById("undoDeleteBtn").style.display = "none"
                }
            }
        }
    </script>
@endsection
