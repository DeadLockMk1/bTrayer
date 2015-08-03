 <div class="flashes">

    <?php for($i=5; $i>=1; $i--):?>
        <?php if (Yii::app()->user->hasFlash('success'.(string)$i) === true):?>

            <div class = 'flashH'>

                <div class="flash success">

                    <?php echo Yii::app()->user->getFlash('success'.(string)$i); ?>
                

                </div>
                
            </div>

        <?php endif; ?>

        <?php if (Yii::app()->user->hasFlash('error'.(string)$i) === true):?>

            <div class = 'flashH'>

                <div class="flash error">

                    <?php echo Yii::app()->user->getFlash('error'.(string)$i); ?>

                </div>
                
            </div>

        <?php endif; ?>

        <?php if (Yii::app()->user->hasFlash('notification'.(string)$i) === true):?>

            <div class = 'flashH'>

                <div class="flash notification">

                    <?php echo Yii::app()->user->getFlash('notification'.(string)$i); ?>

                </div>
                
            </div>

        <?php endif; ?>
    <?php endfor; ?>

    <?php if (Yii::app()->user->hasFlash('success') === true):?>

        <div class = 'flashH'>

            <div class="flash success">

                <?php echo Yii::app()->user->getFlash('success'); ?>

            </div>
            
        </div>

    <?php endif; ?>

    <?php if (Yii::app()->user->hasFlash('error') === true):?>

        <div class = 'flashH'>

            <div class="flash error">

                <?php echo Yii::app()->user->getFlash('error'); ?>

            </div>
            
        </div>

    <?php endif; ?>

    <?php if (Yii::app()->user->hasFlash('notification') === true):?>

        <div class = 'flashH'>

            <div class="flash notification">

                <?php echo Yii::app()->user->getFlash('notification'); ?>

            </div>
            
        </div>
    <?php endif; ?>

 </div>