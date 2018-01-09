<div class="row">
    <div class="col-sm-12">
        <h5> Income statistics Between ( <?= $startDate->format('d/m/Y') ?> - <?= $endDate->format('d/m/Y') ?> ) <span class="pull-right">  Generated On : <?= (new \Cake\I18n\Date())->format('l jS \\of F, Y') ?> </span></h5>
        <?php if ( isset($incomes) ) : ?>
            <table class="table table-responsive ">
                <thead>
                <tr>
                    <th> #</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $collection = new \Cake\Collection\Collection($incomes);
                $totalIncome = $collection->sumOf(function ($data) {
                    // if $data->amount_remaining is set return it else return $data->fee->amount
                    return $data['amount'];
                });
                ?>
                <tr>
                    <td>
                        Total Income Amount
                    </td>
                    <td>
                        <?= $this->Currency->displayCurrency($totalIncome) ?>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php if ( isset($feeCategoriesIncome) ) : ?>
    <div class="row m-t-20">
        <div class="col-sm-12">
            <table class="table table-responsive ">
                <thead>
                <tr>
                    <th> Fees Category</th>
                    <th> Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ( $feeCategoriesIncome as $feeCategoryIncome) : ?>
                    <tr>
                        <td> <?= $feeCategoryIncome['type'] ?> </td>
                        <?php
                        $collection = new \Cake\Collection\Collection($feeCategoryIncome['student_fee_payments']);
                        $total = $collection->sumOf(function ($data) {
                            // if $data->amount_remaining is set return it else return $data->fee->amount
                            return $data['amount_paid'];
                        });
                        ?>
                        <td data-amount="<?= $total ?>" > <?= $this->Currency->displayCurrency($total) ?> </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th> Total</th>
                    <td data-total="total" colspan="2">

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<script>
    // calculating all total in the table
    var totalAmount = 0;
    $('td[data-amount]').each(function(){
        totalAmount += Number($(this).attr('data-amount'));
        console.log($(this).text())
    });
    $('td[data-total]').html('&#8358;'+totalAmount)
</script>