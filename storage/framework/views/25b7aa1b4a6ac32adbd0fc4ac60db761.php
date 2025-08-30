
<h2>Devis #<?php echo e($quoteRequest->id); ?></h2>
<p>Date : <?php echo e(now()->format('d/m/Y')); ?></p>
<p>Client : <?php echo e($quoteRequest->user->name); ?></p>

<table style="width:100%; border-collapse: collapse;" border="1">
    <thead>
    <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    <?php $__currentLoopData = $quoteRequest->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $price = $item->product->activePrice?->amount ?? 0;
            $subtotal = $item->quantity * $price;
            $total += $subtotal;
        ?>
        <tr>
            <td><?php echo e($item->product->name); ?></td>
            <td><?php echo e($item->quantity); ?></td>
            <td><?php echo e(number_format($price, 0, ',', ' ')); ?> Ar</td>
            <td><?php echo e(number_format($subtotal, 0, ',', ' ')); ?> Ar</td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<h4>Total général : <?php echo e(number_format($total, 0, ',', ' ')); ?> Ar</h4>
<?php /**PATH D:\ETU27766\stage\git\backend-madarom(2)\resources\views/pdf/quote.blade.php ENDPATH**/ ?>