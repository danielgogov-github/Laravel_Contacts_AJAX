<div class="row">
    <div class="col-sm-0 col-xl-4"></div>

    <div class="col-sm-12 col-xl-4">
        {!! Form::open(['action' => [$form_array['action'], $contact->id ?? ''], 'class' => $form_array['class'], 'data-contact-id' => $contact->id ?? '']) !!}
        {{ Form::hidden('_method', $form_array['method']) }}
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-center">
                    {{ Form::label('first_name', 'Firstname') }}
                </div>
                <div class="col">
                    {{ Form::text('first_name', $contact->first_name ?? '', ['required' => 'required', 'class' => 'form-control']) }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-center">
                    {{ Form::label('last_name', 'Lastname') }}
                </div>
                <div class="col">
                    {{ Form::text('last_name', $contact->last_name ?? '', ['required' => 'required', 'class' => 'form-control']) }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-center">
                    {{ Form::label('number', 'Number') }}
                </div>
                <div class="col">
                    {{ Form::number('number', $contact->number ?? '', ['required' => 'required', 'class' => 'form-control']) }}
                </div>
            </div>
            
            <div class="text-center">
                {{ Form::submit($form_array['label'], ['class' => 'btn btn-success mt-2 ml-5']) }}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-sm-0 col-xl-4"></div>
</div>

<script>
    $('form.formCreate').on('submit', function(event) {
        event.preventDefault();
        let requestData = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'first_name': $('input[name="first_name"]').val(),
            'last_name': $('input[name="last_name"]').val(),
            'number': $('input[name="number"]').val()
        }
        window.ajaxRequest('POST', '/contacts', requestData, 'Contact created successfully!', 'home');
    });
    
    $('form.formEdit').on('submit', function(event) {
        event.preventDefault();
        let contactId = $(this).data('contact-id');
        let requestUrl = 'contacts/' + contactId;
        let requestData = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'first_name': $('input[name="first_name"]').val(),
            'last_name': $('input[name="last_name"]').val(),
            'number': $('input[name="number"]').val()    
        }
        window.ajaxRequest('PUT', requestUrl, requestData, 'Contact updated successfully!', 'home');
    });        
</script>
