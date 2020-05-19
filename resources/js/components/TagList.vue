<template>
    <div class="tag-list">
        <div class="tag" v-for="(tag, index) in coloredTags" :key="index">
            <a :href="searchUrl+'?q='+tag.tagName" :class="[tag.textColor]">{{ tag.tagName }}</a>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            searchUrl: {
                type: String,
                required: true
            },
            tags: {
                type: Array,
                required: true
            }
        },
        computed: {
            /* List of colored tags */
            coloredTags() {

                let coloredTags = [];

                let prevColor = '';
                
                for (let tag of this.tags) {

                    let colors = [...this.colors];

                    if (prevColor === '') {
                        prevColor = this.selectRandomColor(colors);
                    } else {

                        colors.splice(colors.indexOf(prevColor),1);

                        prevColor = this.selectRandomColor(colors);
                    }
                    
                    coloredTags.push({
                        tagName: tag.tag_name,
                        textColor: `text-${prevColor}`
                    })
                }

                return coloredTags;
            }
        },
        data() {
            return {
                colors: [
                    'primary',
                    'success',
                    'warning',
                    'accent',
                ],
                prevColor: ''
            }
        },
        methods: {
            /* Generated random coo=lors based on the colors data */
            selectRandomColor(colors) {
                let color = colors[Math.floor(Math.random() * colors.length)];

                return color;
            }
        }
    }
</script>