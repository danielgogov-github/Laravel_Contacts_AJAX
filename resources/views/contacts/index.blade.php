@if (count($contacts) > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Number</th>
                <th>Created</th>
                <th>Updated</th>
                <th>-</th>
                <th>-</th>            
            </tr>
            </thead>
            <tbody>
            @foreach ($contacts as $contact)
            <tr data-contact-id="{{ $contact->id }}">
                <td>{{ $contact->first_name }}</td>
                <td>{{ $contact->last_name }}</td>
                <td>{{ $contact->number }}</td>
                <td>{{ $contact->created_at }}</td>
                <td>{{ $contact->updated_at }}</td>
                <td><button class="btn btn-dark button-edit">Edit</button></td>
                <td><button class="btn btn-dark button-delete" >Delete</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $contacts->links() }}
@else
    <div class="alert bg-dark text-light text-center">
        <span class="font-weight-bold">You have no contacts yet</span>
        <span class="text-success">&nbsp;#</span>            
    </div>    
@endif

<script>
    $('a.page-link').on('click', function(event) {
        event.preventDefault();
        let url = $(this).attr('href');
        let requestUrl = window.prepareUrl(url);
        let requestData = {
            '_token': $('meta[name=csrf-token]').attr('content')
        }        
        window.ajaxRequest('GET', requestUrl, requestData);
    }); 

    $('button.button-edit').on('click', function() {
        let contactId = $(this).parent().parent().data('contact-id');
        let requestUrl = 'contacts/'+ contactId +'/edit';
        let requestData = {
            '_token': $('meta[name=csrf-token]').attr('content')
        }
        window.ajaxRequest('GET', requestUrl, requestData, '', 'noAktiv');       
    });    

    $('button.button-delete').on('click', function() {
        if(confirm('Are you sure you want to delete?')) {
            let contactId = $(this).parent().parent().data('contact-id');
            let requestUrl = 'contacts/' + contactId;
            let requestData = {
                '_token': $('meta[name=csrf-token]').attr('content')
            }
            window.ajaxRequest('DELETE', requestUrl, requestData, 'Contact deleted successfully!');
        } 
    });
</script>
