@extends('layouts.library')

@section('title', 'Add New Book')

@section('content')
<!-- ***** Create Area Start ***** -->
<div class="create-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Add <em>New Book</em> To Library</h2>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2">
                <form id="book-form" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="title">Book Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="e.g. The Great Novel" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="author">Author Name <span class="text-danger">*</span></label>
                                <input type="text" name="author" id="author" class="form-control" placeholder="e.g. John Doe" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="description">Book Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="6" required placeholder="Enter book description..."></textarea>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset>
                                <label for="category">Category <span class="text-danger">*</span></label>
                                <select name="category" id="category" class="form-select" required>
                                    <option value="">Select a category</option>
                                    <option value="fiction">Fiction</option>
                                    <option value="non-fiction">Non-Fiction</option>
                                    <option value="science">Science</option>
                                    <option value="history">History</option>
                                    <option value="biography">Biography</option>
                                    <option value="fantasy">Fantasy</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset>
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="cover">Book Cover Image <span class="text-danger">*</span></label>
                                <input type="file" name="cover" id="cover" class="form-control" accept="image/*" required>
                                <small class="form-text text-muted">Upload a high-quality cover image (JPG, PNG, max 5MB)</small>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="publication_date">Publication Date</label>
                                <input type="date" name="publication_date" id="publication_date" class="form-control">
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="isbn">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="form-control" placeholder="e.g. 978-3-16-148410-0">
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="btn btn-primary">Add Book to Library</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ***** Create Area End ***** -->
@endsection

@push('styles')
<style>
    .create-page {
        padding: 80px 0;
    }
    fieldset {
        margin-bottom: 25px;
    }
    label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    .text-danger {
        color: #dc3545;
    }
    #form-submit {
        width: 100%;
        padding: 12px;
        font-weight: 600;
        background-color: #7453fc;
        border: none;
    }
    #form-submit:hover {
        background-color: #5a3fd3;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Form validation can be added here
        $('#book-form').on('submit', function(e) {
            // Add form validation logic here
            // e.preventDefault(); // Uncomment to prevent form submission for validation
        });
    });
</script>
@endpush
