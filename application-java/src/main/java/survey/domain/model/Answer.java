package survey.domain.model;

public class Answer {
	private String id;
	private String content;
	private String date;
	
	public Answer(String id, String content, String date){
		this.id = id;
		this.content = content;
		this.date = date;
	}
	
	public String getId(){
		return this.id;
	}
	
	public String getContent(){
		return this.content;
	}
	
	public String getDate(){
		return this.date;
	}
}
