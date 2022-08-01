@extends('layouts.admin')

@section('title', 'Reports - ')
    
@section('content')
<div class="container col-lg-4 dash-text mt-4">
  <h4>Reports</h4>
</div><br>


<form action="{{ route('admin.genarateReport') }}" method="POST" autocomplete="off">
  @csrf
  <div class="container col-lg-4 dash-text mt-4">

    <div class=" drop ">
      <label for="report" class="form-label reportLable">Report Type</label>
        <select class="form-select drop @error('report') is-invalid @enderror" aria-label="Default select example" name="report">
            <option selected disabled value="">Select Report</option>
            <option value="PR" {{old('report') == "PR"  ? 'selected' : ''}}> Existing product report</option>
            <option value="OR" {{old('report') == "OR"  ? 'selected' : ''}}>Customer order report</option>
            <option value="DR" {{old('report') == "DR"  ? 'selected' : ''}}>Order delivery report</option>
            <option value="SR" {{old('report') == "SR"  ? 'selected' : ''}}>Monthly sales report</option>
            <option value="AR" {{old('report') == "AR"  ? 'selected' : ''}}>Anual sales report</option>

        </select>
        <span class="text-danger">@error('report'){{ $message }}@enderror</span>
    </div>
  </div>


  <div class="container-fluid ">

    <div class="row">
        <div class="col-md-6">
          <div>
              <input name="fromDate" class="form-control datetimepiker1 @error('fromDate') is-invalid @enderror" type="datetime-local" placeholder=" From" value="{{ old('fromDate') }}">  
              <span class="text-danger">@error('fromDate'){{ $message }}@enderror</span>           
          </div>
        </div>
        <div class="col-md-6">

          <div>       
            <input name="toDate" class="form-control datetimepiker2 @error('toDate') is-invalid @enderror" type="datetime-local" placeholder="To" value="{{ old('toDate') }}">
            <span class="text-danger">@error('toDate'){{ $message }}@enderror</span>
          </div>
        </div>
        <div class="displayReport">
          <button type="submit" class="btn btn-primary rounded-0 adminOrder-view-btn">DISPLAY</button>
        </div>
      </div>
    </div>
</form>

@endsection

@section('javascript')
<script>
  config = {
      enableTime: true,
      dateFormat: "Y-m-d H:i",
      altInput: true,
      altFormat:"F j, Y (H:S K)"
  }
  flatpickr("input[type=datetime-local]", config);
</script>
@endsection