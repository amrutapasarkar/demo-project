<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="category" type="text" id="title" value="{{ isset($category->category) ? $category->category : ''}}"  data-parsley-required="true" data-parsley-required-message = "Please enter the Category name " data-parsley-trigger="change focusout" >
    {!! $errors->first('category', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="p_category" class="control-label">{{ 'Category' }}</label>
    <select name="parent_category" class="form-control" id="" > 
     <option>Select category</option>
     @if(isset($category->category))
        @foreach($categories as $allCategory)
            @if($category->parent_id == $allCategory->id)
            <option value="{{ $allCategory->id }}" selected>{{ ucfirst($allCategory->category)}}</option>

            @endif
            <option value="{{ $allCategory->id }}" >{{ ucfirst($allCategory->category)}}</option>
        @endforeach 
        
     @else
        @foreach($categories as $allCategory)
           
            <option value="{{ $allCategory->id }}" >{{ ucfirst($allCategory->category)}}</option>
           
        @endforeach
    @endif  
    </select>
</div>  
<br>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
