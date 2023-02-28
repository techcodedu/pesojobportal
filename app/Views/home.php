<!-- home.php -->

<?=$this->extend('layouts/header')?>

<?=$this->section('content')?>

<!-- Hero section -->
<section class="jumbotron text-center mb-0">
    <div class="container">
        <h1 class="jumbotron-heading mb-4">Find Your Next Job</h1>
        <form class="form-inline mt-3 mb-3" action="/jobs/search" method="get">
            <div class="input-group input-group-lg w-100">
                <input class="form-control form-control-lg rounded-0" type="text" name="q" placeholder="Search jobs"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary rounded-0" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Jobs section -->
<div class="container mt-4">
    <h2 class="mb-4">Latest Job Listings</h2>
    <!-- Add code here to display the list of job listings -->
</div>

<?=$this->endSection()?>