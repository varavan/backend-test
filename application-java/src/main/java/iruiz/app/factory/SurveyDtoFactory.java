package iruiz.app.factory;

import java.util.Iterator;
import org.springframework.context.annotation.Configuration;
import iruiz.app.dto.AnswerDto;
import iruiz.app.dto.QuestionDto;
import iruiz.app.dto.SurveyDto;
import iruiz.app.dto.TagDto;
import iruiz.survey.domain.model.Answer;
import iruiz.survey.domain.model.Question;
import iruiz.survey.domain.model.Survey;
import iruiz.survey.domain.model.Tag;

@Configuration
public class SurveyDtoFactory {
	
	public SurveyDto makeFromSurveyModel(Survey survey){
		SurveyDto surveyDto = new SurveyDto();
		
		surveyDto.name = survey.getName();
		surveyDto.description = survey.getDescription();
		surveyDto.slug = survey.getSlug();
		surveyDto.createdAt = survey.getCreatedAt();
		
		for(Iterator<Question> quest = survey.getQuestions().iterator(); quest.hasNext(); ){
			Question question = quest.next();
			QuestionDto questionDto = new QuestionDto();
			questionDto.title = question.getName();
			questionDto.createdAt = question.getCreatedAt();
			
			for(Iterator<Answer> ans = question.getAnswers().iterator(); ans.hasNext(); ){
				Answer answer = ans.next();
				AnswerDto answerDto = new AnswerDto();
				answerDto.content = answer.getContent();
				answerDto.createdAt = answer.getDate();
				
				questionDto.addAnswer(answerDto);
				
			}
			
			surveyDto.addQuestion(questionDto);	
		}
		
		for(Iterator<Tag> tg = survey.getTags().iterator(); tg.hasNext(); ){
			Tag tag = tg.next();
			TagDto tagDto = new TagDto();
			tagDto.name = tag.getName();
			tagDto.slug = tag.getSlug();
			tagDto.description = tag.getDescription();
			tagDto.createdAt = tag.getCreatedAt();
			
			surveyDto.addTag(tagDto);	
		}
		
	
		
		return surveyDto;
	}
}
