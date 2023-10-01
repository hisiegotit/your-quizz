<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="text-gradient text-primary text-uppercase text-lg font-weight-bold my-2">Online Quiz</p>
                <div class="card">
                    <div class="card-body">
                        <div class="navigation d-flex justify-content-between mb-2">
                            <span class="badge bg-dark">{{ time }}</span>
                        <div v-show="questionIndex+1 <= questions.length">
                            <span  class="d-flex justify-end"> {{ questionIndex+1 }}/ {{ questions.length }}</span>
                        </div>
                        </div>
                        <div v-for="(question, index) in questions">
                            <div v-show="index===questionIndex">

                                <a class="card-title h5 d-block text-darker">
                                    {{ question.question }}
                                </a>
                                <ul v-for="choice in question.answers" class="list-group">
                                    <div class="form-check mb-3">
                                        <input type="radio" :id="choice.id"
                                        :value="choice.is_correct == true ? true : choice.answer"
                                        :name = "index"
                                        v-model="userResponse[index]"
                                        @click="choices(question.id, choice.id)"
                                        >

                                        <label class="custom-control-label" :for="choice.id">{{ choice.answer }}</label>
                                    </div>
                                </ul>
                            </div>
                        </div>

                        <div v-if="questionIndex === questions.length">
                            <p class="align-middle text-center">You got {{ score() }} / {{ questions.length }}</p>
                        </div>

                        <div v-show="questionIndex != questions.length" class="navigation d-flex justify-content-between">
                            <button class="btn btn-primary" v-show="questionIndex > 0 && questionIndex < questions.length" @click="prev()">Previous</button>
                            <button class="btn btn-primary" v-show="questionIndex < questions.length" @click="next(); postUserChoice()">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
    export default {
        props: ['quizid', 'quizQuestions', 'hasCompletedQuiz', 'times'],
        data(){
            return {
                questions: this.quizQuestions,
                questionIndex: 0,
                userResponse: Array(this.quizQuestions.length).fill(false),
                currentQuestion: 0,
                currentAnswer: 0,
                clock: moment(this.times*60*1000),
            }
        },
        mounted() {
            setInterval(() => {
                this.clock = moment(this.clock.subtract(1, 'second'))
            }, 1000);
        },
        computed: {
            time: function(){
                var time = this.clock.format('mm:ss');
                if(time == '00:00'){
                    alert('Time is up!');
                    window.location.replace('/home');
                }
                return time;
            }
        },
        methods: {
            next() {
                this.questionIndex++;
            },
            prev() {
                this.questionIndex--;
            },
            choices(question, answer){
                this.currentQuestion = question,
                this.currentAnswer = answer
            },
            score(){
                return this.userResponse.filter(function(val){
                    return val === true;
                }).length
            },
            postUserChoice(){
                axios.post('/result/store', {
                    answerID: this.currentAnswer,
                    questionID: this.currentQuestion,
                    quizID: this.quizid,
                }).then((response)=>{
                    console.log(response)
                }).catch((error)=>{
                    alert(error)
                });
            }
        }
    }
</script>
