<script>
export default {
  inheritAttrs: false,
  name: "Quizz",
  props: {
    records: {
      type: Array,
      required: true,
    },
    answer: {
      type: Array,
      required: true,
    },
    answerbad: {
      type: Array,
      required: true,
    },
    topic: {
      type: String,
      required: true,
    },
    selectedImage: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      countDownResponse: this.records,
      countDownResponseTimer: 1,
      answerBad1: this.answerBad,
      answers: ["-71", "50"],
      
      awesome: false,
      right: 0,
    };
  },
  computed: {
    selectedModeLabel() {
      return this.selectedImage == "fastQuizz" ? "Szybki quiz" : "Pełny quiz";
    },
  },
  methods: {
    toggleQuestion() {

      if (this.countDownResponseTimer > 0) {
        this.countDownResponseTimer -= 1;
      } else {
        this.countDownResponseTimer = this.countDownResponse.length - 1;
      }

      this.randomList(this.answers)
      //this.randomList(this.countDownResponse)
      this.right = 0
      console.log(this.answer);
      console.log("++++++++++");
      console.log(this.answerbad[this.countDownResponseTimer].answerBad);
    },

    recordContent(record) {

      return record.question;
    },
    countDownTimer() {
      // Your countdown logic
    },
    randomList(rand) {
      rand.sort(() => 0.5 - Math.random());
    },
    checkAnswer(answer) {
      console.log("pogo" + answer)
      console.log(this.answers[0])
      this.right = answer === this.answerbad[this.countDownResponseTimer].answerBad ? 1 : 2;
    },
  },
  created() {
    console.log("Component created"); // Ensure Vue instance is created
    this.countDownResponse = this.records.slice(); // Initialize the array
    this.countDownTimer();
    //this.randomList(this.countDownResponse);
    //this.randomList(this.answers);

  },
  mounted() {

    //console.log("Records:", this.records); // Check the passed props
  },
};
</script>

<template>
  <div>
    <h1>{{ topic }}</h1>
    <p>Selected Mode: {{ selectedModeLabel }}</p>
    <ul v-if="records.length">
      <li v-for="(record, index) in records" :key="index">
        <!-- Display the question content -->
        <div v-html="recordContent(record)"></div>
      </li>
    </ul>
    <p v-else>No questions available.</p>
  </div>

  <button @click="toggleQuestion()">Toggle</button>
  <br />
  <button @click="checkAnswer(answers[1])">{{ this.answerbad[this.countDownResponseTimer].answerBad}}</button><br />
  <button @click="checkAnswer(answers[0])">{{ answers[1] }}</button><br />
  <button @click="checkAnswer(answers[2])">{{ answers[2] }}</button><br />
  <button @click="checkAnswer(answers[3])">{{ answers[3] }}</button><br />
  <h1 v-if="countDownResponseTimer >= 0 && countDownResponseTimer < countDownResponse.length">
    {{ countDownResponse[countDownResponseTimer].question }}
  </h1>
  
  <span v-if="right == 0"></span>
  <span v-if="right == 1">good</span>
  <span v-if="right == 2">bad</span>
</template>

<style>
/* Include any component-specific styles here */
</style>
