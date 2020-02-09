<div class="dictionary" id="dictionary" >
    <div class="dictionary-card" v-if="switchFooterFunction == 1">
        <div class="highlight-box">
            <h1>Highlight Color</h1>
            <div class="color-image" @click="switchHighlightColor(0)"
                style="background-color: #FF89FF;">
            </div>
            <div class="color-image" @click="switchHighlightColor(1)"
                style="background-color: #89DB89;">
            </div>
            <div class="color-image" @click="switchHighlightColor(2)"
                style="background-color: #90AFEE;">
            </div>
            <div class="color-image" @click="switchHighlightColor(3)"
                style="background-color: #C8AAF2;">
            </div>
            <div class="color-image" @click="switchHighlightColor(4)"
                style="background-color: #8BDEDE;">
            </div>
            <div class="color-image" @click="switchHighlightColor(5)"
                style="background-color: #FF9999;">
            </div>
        </div>
    </div>
    <div class="dictionary-card" v-if="switchFooterFunction == 2"
        v-bind:style="{ boxShadow: dictionaryBoxShadow }">
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
            <p></p>
        </div>
    </div>
</div>

<script src="/js/dictionary.js" type="text/javascript"></script>
