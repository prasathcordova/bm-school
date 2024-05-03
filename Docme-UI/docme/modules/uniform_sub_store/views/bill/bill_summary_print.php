<table class="" style="width:120mm;padding-top: <?php echo $padding; ?>mm" border="0">
    <tbody>
        <tr>
            <td colspan="2" style="font-size: 10px;font-family: Arial;">Bill Summary
                <br />
                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            </td>
        <tr>
            <td style="padding-top:5px;font-size: 10px;font-family: Arial;"><strong>Sub Total :</strong></td>
            <td style="padding-top:5px;font-size: 10px;font-family: Arial;padding-left: 10px;">
                <p id="tbl_subtotal"><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['sub_total'] + $details_data['master_data']['round_off']; ?></p>
            </td>
        </tr>

        <tr>
            <td style="padding-top:2px;font-size: 10px;font-family: Arial;"><strong><?php echo TAXNAME  ?> :</strong></td>
            <td style="padding-top:2px;font-size: 10px;font-family: Arial;padding-left: 10px;" id="">
                <p id="tbl_tax"><?php echo CURRENCY  ?> <?php echo my_money_format($details_data['master_data']['tax_amount']); ?></p>
            </td>
        </tr>
        <tr>
            <td style="padding-top:2px;font-size: 10px;font-family: Arial;"><strong>Discount :</strong></td>
            <td style="padding-top:2px;font-size: 10px;font-family: Arial;padding-left: 10px;" id="">
                <p id="tbl_discount"><?php echo CURRENCY  ?> <?php echo my_money_format($details_data['master_data']['discount_amount']); ?></p>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding-top:2px;font-size: 10px;font-family: Arial;"><strong>Total :</strong></td>
            <td style="padding-top:2px;font-size: 10px;font-family: Arial;padding-left: 10px;" id="">
                <p id="tbl_total"><?php echo CURRENCY  ?> <?php echo my_money_format($details_data['master_data']['final_total']); ?></p>
            </td>
        </tr>

        </tr>
    </tbody>
</table>