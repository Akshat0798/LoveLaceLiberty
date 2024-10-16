<table>
    <thead style="background-color: green; color: skyblue; border: 3px solid #ee00ee">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Gender</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            @if($user->full_name)
            <td>{{ $user->full_name }}</td>
            @else
            <td> - </td>
            @endif
            @if($user->email)
            <td>{{ $user->email }}</td>
            @else
            <td> - </td>
            @endif
            @if($user->dob)
            <td>{{ $user->dob }}</td>
            @else
            <td> - </td>
            @endif
            @if($user->gender)
            <td>{{ $user->gender  }}</td>
            @else
            <td> - </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>