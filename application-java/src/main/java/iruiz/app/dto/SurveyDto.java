package iruiz.app.dto;

import java.util.ArrayList;

public class SurveyDto {
    public String name;

    public String slug;

    public String description;
    
    public String createdAt;

    public ArrayList<TagDto> tags;

    public ArrayList<QuestionDto> questions;
    
    public SurveyDto(){
    	this.questions = new ArrayList<QuestionDto>();
    	this.tags = new ArrayList<TagDto>();
    }
    
    public void addTag(TagDto tag){
    	this.tags.add(tag);
    }
    
    public void addQuestion(QuestionDto question){
    	this.questions.add(question);
    }
}
