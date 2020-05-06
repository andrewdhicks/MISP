<?php
?>
<div style="display: flex; min-height: 600px;">
    <div style="flex: 1; padding: 5px;">
        <div id="referencesQuickAddForm">
            <label for="RelationshipSource"><?= __('Source UUID') ?></label>
            <input id="RelationshipSource" type="text" value="<?= h($cluster['GalaxyCluster']['uuid']) ?>" disabled></input>
            <label for="RelationshipType"><?= __('Relationship type') ?></label>
            <select id="RelationshipType">
                <?php foreach ($references as $reference): ?>
                    <option value="<?= h($reference) ?>"><?= h($reference) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="RelationshipTarget"><?= __('Target UUID') ?></label>
            <select></select>
            <input id="RelationshipTarget" type="text"></input>
            <button id="buttonAddRelationship" type="button" class="btn btn-block btn-primary">
                <i class="fas fa-plus"></i>
                Add relationship
            </button>
        </div>
    </div>

    <div style="flex: 4; padding: 5px; background-color: steelblue;">
        <?php debug($references); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // $('#referencesQuickAddForm select').chosen();
    })
    $('#buttonAddRelationship').click(function() {
        submitRelationshipForm();
    })

    function submitRelationshipForm() {
        var url = "<?= $baseurl ?>/galaxy_clusters/addReference/";
        $.ajax({
            beforeSend: function (XMLHttpRequest) {
                toggleLoadingButton(true);
            },
            data: $('#referencesQuickAddForm').serialize(),
            success: function (data, textStatus) {
                $('#top').html(data);
                showMessage("success", "Reference added");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage('fail', textStatus + ": " + errorThrown);
            },
            complete: function() {
                toggleLoadingButton(false);
            },
            type:"post",
            cache: false,
            url: url,
        });
    }

    function toggleLoadingButton(loading) {

    }
</script>