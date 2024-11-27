<tr>
    <td x-show="id" x-transition x-cloak>{{ $reserve->reservID }}</td>
    <td x-show="name" x-transition x-cloak>{{ $reserve->name }}</td>
    <td x-show="foodName" x-transition x-cloak>{{ $reserve->foodName }}</td>
    <td x-show="date" x-transition x-cloak>{{ verta($reserve->reservDate)->formatDate() }}</td>
</tr>