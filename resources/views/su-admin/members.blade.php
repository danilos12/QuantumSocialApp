<div class="container">
    <h1 class="center">{{ $title }}</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Full name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Is Verified</th>
            <th scope="col">API Access</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($getAll as $user)
            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->isverified === 1 ? 'YES' : 'NO' }}</td>
            <td>{{ $user->api_access === 1 ? 'YES' : "NO" }}</td>
            <td>
                <img src="{{ asset('public/ui-images/icons/05-drafts.svg') }} " class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit">
                <img src="{{ asset('public/ui-images/icons/pg-trash.svg') }} " class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit">
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>