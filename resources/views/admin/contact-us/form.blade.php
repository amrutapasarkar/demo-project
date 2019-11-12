<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($contactus->name) ? $contactus->name : ''}}" readonly>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($contactus->email) ? $contactus->email : ''}}" readonly>
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="control-label">{{ 'Contact US' }}</label>
    <input class="form-control" name="contactNo" type="text" id="contactNo" value="{{ isset($contactus->contactNo) ? $contactus->contactNo : ''}}" readonly>
    {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="control-label">{{ 'Message' }}</label>
    <textarea class="form-control" rows="5" name="message" type="textarea" id="message" readonly>{{ isset($contactus->message) ? $contactus->message : ''}}</textarea>
    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="message" class="control-label">{{ 'Note' }}</label>
    <textarea class="form-control" rows="5" name="note" type="textarea" id="message"  data-parsley-required="true" data-parsley-required-message = "Please add the note." data-parsley-trigger="change focusout"></textarea>
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
