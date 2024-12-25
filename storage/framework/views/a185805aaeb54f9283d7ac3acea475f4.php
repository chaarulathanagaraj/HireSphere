<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <!-- Header content if needed -->
     <?php $__env->endSlot(); ?>

    <style>
        /* General Body Styling */
        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffffff; /* White background */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        h1 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #333;
            color: white;
            padding: 10px;
        }

        td {
            text-align: center;
            padding: 10px;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .form-label {
            color: #333;
        }

        .form-control, .form-select {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #333;
            outline: none;
            box-shadow: 0 0 5px rgba(51, 51, 51, 0.3);
        }

        .btn-primary {
            background-color: #333;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        /* Pagination Styling */
        .pagination .page-link {
            background-color: #f9f9f9;
            border-color: #ccc;
        }

        .pagination .page-link:hover {
            background-color: #333;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #333;
            color: white;
            border-color: #333;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f9f9f9;
            color: #ccc;
        }

        /* Customizing Form Layout */
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .col-md-4 {
            padding-right: 15px;
        }

        /* Align filter button to the right */
        .filter-button {
            display: flex;
            justify-content: flex-end;
        }

        /* Making the labels consistent */
        label {
            color: #333;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <h1>Hired Candidates Details </h1>

        <!-- Filtering form -->
        <form method="GET" action="<?php echo e(route('hiring.details')); ?>">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                </div>
                <div class="col-md-4 filter-button">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            <div class="mb-3">
                <label for="rows" class="form-label">Rows per page</label>
                <select name="rows" class="form-select">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select>
            </div>
        </form>

        <!-- Requirement details table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Role Name</th>
                    <th>Candidate Name</th>
                    <th>Joining Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $hiringData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($detail->team_name); ?></td>
                    <td><?php echo e($detail->role_name); ?></td>
                    <td><?php echo e($detail->candidate_name); ?></td>
                    <td><?php echo e($detail->joined_date); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if($hiringData->currentPage() > 1): ?>
                <li class="page-item"><a class="page-link" href="<?php echo e($hiringData->previousPageUrl()); ?>">Previous</a></li>
                <?php else: ?>
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                <?php endif; ?>

                <li class="page-item disabled"><span class="page-link"><?php echo e($hiringData->currentPage()); ?></span></li>

                <?php if($hiringData->hasMorePages()): ?>
                <li class="page-item"><a class="page-link" href="<?php echo e($hiringData->nextPageUrl()); ?>">Next</a></li>
                <?php else: ?>
                <li class="page-item disabled"><span class="page-link">Next</span></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sample\resources\views/hiring_details.blade.php ENDPATH**/ ?>