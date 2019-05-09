
<?php $__currentLoopData = $chart->plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make($chart->pluginsViews[$plugin], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script <?php echo $chart->displayScriptAttributes(); ?>>
    var ctvChart = document.getElementById('<?php echo e($chart->id); ?>').getContext('2d');
    function <?php echo e($chart->id); ?>_create(data) {
        <?php echo e($chart->id); ?>_rendered = true;
        document.getElementById("<?php echo e($chart->id); ?>_loader").style.display = 'none';
        document.getElementById("<?php echo e($chart->id); ?>").style.display = 'block';
        window.<?php echo e($chart->id); ?> = new Chart(document.getElementById("<?php echo e($chart->id); ?>").getContext("2d"), {
            type: <?php echo $chart->type ? "'{$chart->type}'" : 'data[0].type'; ?>,
            data: {
                labels: <?php echo $chart->formatLabels(); ?>,
                datasets: data
            },
            options: <?php echo $chart->formatOptions(true); ?>,
            plugins: <?php echo $chart->formatPlugins(true); ?>

        });
    }
    <?php if($chart->api_url): ?>
    let <?php echo e($chart->id); ?>_refresh = function (url) {
        document.getElementById("<?php echo e($chart->id); ?>").style.display = 'none';
        document.getElementById("<?php echo e($chart->id); ?>_loader").style.display = 'flex';
        if (typeof url !== 'undefined') {
            <?php echo e($chart->id); ?>_api_url = url;
        }
        fetch(<?php echo e($chart->id); ?>_api_url)
            .then(data => data.json())
            .then(data => {
                document.getElementById("<?php echo e($chart->id); ?>_loader").style.display = 'none';
                document.getElementById("<?php echo e($chart->id); ?>").style.display = 'block';
                <?php echo e($chart->id); ?>.data.datasets = data;
                <?php echo e($chart->id); ?>.update();
            });
    };
    <?php endif; ?>
<?php echo $__env->make('charts::init', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/vendor/consoletvs/charts/src/Views/chartjs/script.blade.php ENDPATH**/ ?>