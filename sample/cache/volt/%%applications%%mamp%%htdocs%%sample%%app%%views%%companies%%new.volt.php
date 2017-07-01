
<?= $this->getContent() ?>

<?= $this->tag->form(['companies/create']) ?>

    <ul class="pager">
        <li class="previous pull-left">
            <?= $this->tag->linkTo(['companies/search', '&larr; 戻る']) ?>
        </li>
        <li class="pull-right">
            <?= $this->tag->submitButton(['保存', 'class' => 'btn btn-success']) ?>
        </li>
    </ul>

    <fieldset>

    <?php foreach ($form as $element) { ?>
        <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
            <?= $element ?>
        <?php } else { ?>
            <div class="form-group">
                <?= $element->label() ?>
                <?= $element->render(['class' => 'form-control']) ?>
            </div>
        <?php } ?>
    <?php } ?>

    </fieldset>

</form>
