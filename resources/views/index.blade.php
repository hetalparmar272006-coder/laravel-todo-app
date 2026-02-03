<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>My Tasks</h2>
    <table border="1"cellpadding="10">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Completed</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>