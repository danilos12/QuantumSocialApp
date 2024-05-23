<div class="container">
    <h1 class="center">{{ $title }}</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Subscription ID</th>
            <th scope="col">Subscription Name</th>
            <th scope="col">Mamber Count</th>
            <th scope="col">Post Credits</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($getAll as $plan)
            <tr>
            <th scope="row">{{ $plan->id }}</th>
            <td>{{ $plan->subscription_id }}</td>
            <td>{{ ucfirst($plan->subscription_name) }}</td>
            <td>{{ $plan->member_count }}</td>
            <td>{{ $plan->mo_post_credits === 0 ? 'Unlimited' : $plan->mo_post_credits }}</td>
            <td>
                <img src="{{ asset('public/ui-images/icons/05-drafts.svg') }} " class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit">
                <img src="{{ asset('public/ui-images/icons/pg-trash.svg') }} " class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit">
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>