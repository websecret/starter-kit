<div class="invalid-feedback js-form__input-error">
    <?php if ($showError && isset($errors)): ?>
        <?php foreach ($errors->get($nameKey) as $err): ?>
            <div <?= $options['errorAttrs'] ?>><?= $err ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


