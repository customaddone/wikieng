<div class="dictionary" id="dictionary" >
    <div class="dictionary-card" v-if="switchFooterFunction == 2">
        <div class="dictionary-header">
            <i class="fa fa-comment-o "></i>
        </div>
        <div class="dictionary-text">
            <div class="dictionary-title"  @click="saveWord">
                <p>@{{ seeWord }}</p>
            </div>
            <div class="dictionary-article">
                <p>@{{ translatedWord }}</p>
            </div>
        </div>
        <div class="dictionary-footer">
            <i class="fa fa-edit "></i>
            <p>See more</p>
        </div>
    </div>
</div>

<script src="/js/dictionary.js" type="text/javascript"></script>
