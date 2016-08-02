package iruiz.app.component;

import java.util.Iterator;
import iruiz.app.dto.AnswerDto;
import iruiz.app.dto.QuestionDto;
import iruiz.app.dto.SurveyDto;
import iruiz.app.dto.TagDto;

public class SurveyDtoToJsonTransformer {
	
	public static String transform(SurveyDto surveyDto){
		
		String questions = "[";
		for(Iterator<QuestionDto> quest = surveyDto.questions.iterator(); quest.hasNext(); ){
			QuestionDto questionDto = quest.next();
			
			String answersJson = "[";
			for(Iterator<AnswerDto> ans = questionDto.answers.iterator(); ans.hasNext(); ){
				AnswerDto answerDto  = ans.next();
				
				answersJson = answersJson + "{"
						+ "\"content\": \""+ answerDto.content + "\","
						+ "\"createdAt\": \""+ answerDto.createdAt + "\""
						+ "}";
				
				if(ans.hasNext()){
					answersJson = answersJson + ",";
				}
				
			}
			answersJson = answersJson + "]";
			
			questions = questions +  "{"
					+ "\"title\": \""+ questionDto.title + "\","
					+ "\"createdAt\": \""+ questionDto.createdAt + "\","
					+ "\"answers\": " + answersJson
					+ "}";
			
			if(quest.hasNext()){
				questions = questions + ",";
			}
			
		}
		questions = questions + "]";
		
		String tags = "[";
		for(Iterator<TagDto> tg = surveyDto.tags.iterator(); tg.hasNext(); ){
			TagDto tagDto = tg.next();
			
			tags = tags + "{"
					+ "\"name\": \""+ tagDto.name + "\","
					+ "\"slug\": \""+ tagDto.slug + "\","
					+ "\"description\": \""+ tagDto.description + "\","
					+ "},";
			
		}
		tags = tags + "]";
		
		return "{"
				+ "\"name\": \""+ surveyDto.name + "\","
				+ "\"slug\": \""+ surveyDto.slug + "\","
				+ "\"description\": \""+ surveyDto.description + "\","
				+ "\"tags\": "+ tags + ","
				+ "\"questions\": " +questions + ","
				+ "\"createdAt\": \""+ surveyDto.createdAt + "\""
		+ "}";
	}
}
