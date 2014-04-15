<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<style>
    .groups{
        margin-top: 4px;
    }
    .groups a{
        display: inline-block;
        padding: 1px 5px;
        border: 1px solid #aaa;
        background: #dadada;
        color: #777;
        border-radius: 3px;
        text-decoration: none;
    }

    .groups a:hover, .groups a.active{
        background: green;
        color: white;
        border: 1px solid #006101;
    }
</style>
<h1 style="font-size: 40px; float: right">DONANIMLAR</h1>
<table class="table table-bordered table-striped" style="margin: 30px 0">
    <thead style="background: #bbb;">
        <tr>
            <th style="width: 80px; text-align: center">Araç ID</th>
            <th>Araç Resim</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Araç Grup</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->getAllCar as $car): ?>

            <tr id="tableTr-<?php echo $car->carPkey ?>">
                <td style="width: 80px; text-align: center"><?php echo $car->carPkey?></td>
                <td style="width: 200px"><?php echo html::img(array('style'=>'width: 100px','src'=>'images/'.$car->markaResim)); ?></td>
                <td><?php echo $car->markaad?></td>
                <td><?php echo $car->model?></td>
                <td>

                <strong>GROUP</strong>
                <div class="groups">
                    <?php echo $car->cars_group?>
                    <?php for($i = 0; $i<count($this->groups); $i++): ?>
                        <a class="<?php echo $this->groups[$i]->groupId == $car->car_group ? 'active' : null ?>" href="<?php  echo BASEPATH?>Cars/addCarToGroup/?CarId=<?php echo $car->carPkey?>&GroupId=<?php echo $this->groups[$i]->groupId?>"><?php echo $this->groups[$i]->groupName?></a>
                    <?php endfor; ?>
                    <p><em>Araçı gruba eklemek için eklemek istediğiniz guruba tıklayınız.</em></p>
                </div>


                </td>

            </tr>
        <?php endforeach;?>
    </tbody>
</table>