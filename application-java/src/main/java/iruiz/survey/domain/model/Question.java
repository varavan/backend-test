package iruiz.survey.domain.model;

import java.util.ArrayList;

public final class Question {
	
	private String name;
	private String description;
	private String createdAt;
	private ArrayList<Answer> answers;
	
	public Question(String name, String description, String createdAt){
		this.name = name;
		this.description = description;
		this.createdAt = createdAt;
	}
	
	public void addAnswer(Answer answer){
		this.answers.add(answer);
	}
	
	public ArrayList<Answer> getAnswers(){
		return this.answers;
	}
	
	public String getName(){
		return this.name;
	}
	
	public String getDescription(){
		return this.description;
	}
	
	public String getCreatedAt(){
		return this.createdAt;
	}
}
