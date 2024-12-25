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

        /* Badge Styling */
        .badge {
            font-size: 12px;
            padding: 5px 10px;
        }

        /* Customizing Form Layout */
        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .col-md-5, .col-md-2 {
            padding-right: 15px;
        }

        /* Making the labels consistent */
        label {
            color: #333;
            font-weight: bold;
        }

        /* Row styling for filtering form */
        .filter-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-col {
            width: 48%;
        }

        .filter-btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
    </style>

    <!-- Content goes here -->
    <div class="container">
        <h1>Hired Candidates Details</h1>

        <!-- Filtering form -->
        <form method="GET" action="<?php echo e(url('/hired')); ?>">
            <div class="filter-row">
            <div class="filter-col">
                    <select class="form-control" id="team" name="team" required>
                        <option value="" disabled selected>Select Your Team</option>
                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($team); ?>"><?php echo e($team); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="filter-col">
                
                    <input type="date" name="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
                    
                  
                </div>
                <div class="filter-col">  <input type="date" name="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>"></div>
                <div class="filter-col">
                   
                    <select name="rows" class="form-select">
                        <option value="5" <?php echo e(request('rows', 5) == 5 ? 'selected' : ''); ?>>5</option>
                        <option value="10" <?php echo e(request('rows') == 10 ? 'selected' : ''); ?>>10</option>
                        <option value="15" <?php echo e(request('rows') == 15 ? 'selected' : ''); ?>>15</option>
                        <option value="20" <?php echo e(request('rows') == 20 ? 'selected' : ''); ?>>20</option>
                        <option value="25" <?php echo e(request('rows') == 25 ? 'selected' : ''); ?>>25</option>
                        <option value="50" <?php echo e(request('rows') == 50 ? 'selected' : ''); ?>>50</option>
                        <option value="75" <?php echo e(request('rows') == 75 ? 'selected' : ''); ?>>75</option>
                        <option value="100" <?php echo e(request('rows') == 100 ? 'selected' : ''); ?>>100</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="filter-btn">Filter</button>
        </form>

        <!-- Hiring details table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team</th>
                    <th>Role</th>
                    <th>Candidate Name</th>
                    <th>Joined Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $hiringData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row->team_name); ?></td>
                    <td><?php echo e($row->role_name); ?></td>
                    <td><?php echo e($row->candidate_name); ?></td>
                    <td><?php echo e($row->joined_date); ?></td>
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
<?php /**PATH C:\xampp\htdocs\sample\resources\views/hired.blade.php ENDPATH**/ ?>