package iruiz.app.dto;

import java.util.ArrayList;

public class QuestionDto {

    public String title;

    public String createdAt;

    public ArrayList<AnswerDto> answers;
    
    public QuestionDto(){
    	this.answers = new ArrayList<AnswerDto>();
    }
    
    public void addAnswer(AnswerDto answer){
    	this.answers.add(answer);
    }
}
