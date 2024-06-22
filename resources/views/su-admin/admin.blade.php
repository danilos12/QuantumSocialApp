<div class="container">
    <h1 class="center">{{ $title }}</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Email</th>
            <th scope="col">Plan</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($getAll as $user)
            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->subscription_name) }}</td>
            <td>
                <img src="{{ asset('public/ui-images/icons/05-drafts.svg') }} " class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit">
                <img src="{{ asset('public/ui-images/icons/pg-trash.svg') }} " class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit">
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>