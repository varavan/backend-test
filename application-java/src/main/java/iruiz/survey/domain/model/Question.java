package iruiz.survey.domain.model;

import java.util.ArrayList;
import iruiz.utils.Slugify;

public final class Question {
	
	private String name;
	private String slug;
	private String description;
	private String createdAt;
	private ArrayList<Answer> answers;
	
	public Question(String name, String description, String createdAt){
		this.name = name;
		this.slug = Slugify.toSlug(name);
		this.description = description;
		this.createdAt = createdAt;
		this.answers = new ArrayList<Answer>();
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
	
	public String getSlug(){
		return this.slug;
	}
	
	public String getDescription(){
		return this.description;
	}
	
	public String getCreatedAt(){
		return this.createdAt;
	}
}
